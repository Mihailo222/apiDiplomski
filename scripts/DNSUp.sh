#! /bin/bash

if [ "$#" -ne 4 ]; then
    echo "Usage: $0 <dns_ip_address> <ws_ip_address> <fqdn1> <fqdn2>"
    exit 1
fi



dns_ipa="$1"
ws_ipa="$2"
fqdn1="$3"
fqdn2="$4"


domain=$(echo "${fqdn1}" | awk -F. '{print $(NF-1)"."$NF}')
reversed_mask=$(echo "${dns_ipa}" | awk -F. '{print $3"."$2"."$1}')



echo "acl \"trusted_clients\" {
${dns_ipa};
${ws_ipa};
localhost;
};


options {
        directory \"/var/cache/bind\";


          forwarders {
                8.8.8.8;
                8.8.4.4;
          };

        dnssec-validation auto;

        auth-nxdomain no;

        listen-on-v6 { ::1; };

        listen-on port 53 {  localhost; ${dns_ipa}; };



        recursion yes;
        allow-recursion {  trusted_clients; };
        allow-query {  trusted_clients; };
        allow-query-cache { trusted_clients; };


};" > "/etc/bind/named.conf.options"


#kako ovde reverzirati 56.168.192-neki substring;  za subnet 192.168.56.X radi
#menja i domena koji user zeli da postavi
echo "
zone \"${domain}\" IN {
type master;
file \"/etc/bind/${domain}.fwd\";

};


zone \"${reversed_mask}.in-addr.arpa\" IN {
type master;
file \"/etc/bind/${domain}.rev\";

};" > "/etc/bind/named.conf.local"


cd "/etc/bind"
touch "${domain}.fwd"
touch "${domain}.rev"


echo "${domain}. 1w IN SOA ns1.${domain}. hostmaster.${domain} 1 1d 1h 1w 1h
${domain}. 1w IN NS ns1.${domain}.
ns1.${domain}. 1w IN A ${dns_ipa}
${fqdn1}. 1w IN A ${ws_ipa}
${fqdn2}. 1w IN A ${ws_ipa}" > "${domain}.fwd"


reversed_dns=$(echo "$dns_ipa" | awk -F. '{for(i=NF;i>0;i--) printf "%s%s", $i, (i>1 ? "." : ""); print ""}')
reversed_ws=$(echo "$ws_ipa" | awk -F. '{for(i=NF;i>0;i--) printf "%s%s", $i, (i>1 ? "." : ""); print ""}')

echo "${reversed_mask}.in-addr.arpa. 1w IN SOA ns1.${domain}. hostmaster.${domain} 1 1d 1h 1w 1h
${reversed_mask}.in-addr.arpa. 1w IN NS ns1.${domain}.
${reversed_dns}.in-addr.arpa. 1w IN PTR ns1.${domain}.
${reversed_ws}.in-addr.arpa. 1w IN PTR ${fqdn1}.
${reversed_ws}.in-addr.arpa. 1w IN PTR ${fqdn2}." > "${domain}.rev"

echo "nameserver ${dns_ipa}" > "/etc/resolv.conf"

service bind9 restart
