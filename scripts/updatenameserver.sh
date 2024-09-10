#!/bin/bash
dns_ipa="$1"
echo "nameserver ${dns_ipa}" > "/etc/resolv.conf"
