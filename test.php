<?php

$string = 'MIICeQIBADANBgkqhkiG9w0BAQEFAASCAmMwggJfAgEAAoGBAM2noWpwtuU00QVR
qad/D6ysnBmKLm8FZPXpHw70CP+MtV2DXtx1x+swyIixAUEAAzyymZ7FijkbNMX7
7TcO7Z7CW5aR+pK9vE5xjc5wQiPknQOqpddUiK1/yGllzGCS/iwnXLFP8Imo6SWF
mYlKxTyG9FVJkP43xyAmZ8x7Vl+tAgMBAAECgYEAmN1DZGUH7fOGcteyragKtKVR
GsLVpPxzgT6ZMXo/vgSPQ0VFG8YIpk+Kn+BCOFiUD2gKPDRFfBE29vs95jEYehYB
/mQZvLOZ0zl+3s+r/lub15o3Aqch95SXWLoev3yYeP0bl7ddSo8zfde38TA4qjAs
HcZshzm/ka0YxDnkZNkCQQDy0vsBrbcP1OkrgmJL3XYzBCYu88GwIZxJV3c52FZf
p6IIagDiUJ6RjmXItuZwT5o8+s8QJqgoSgxuNxFVSGjrAkEA2NBWqwGcSNV17PAF
OOJZrSESl3CPARGitEQUu4GNjTDnfH9S0XesuGoZXRBUjPJWOKmgBjfN6zaZChsC
f/IzxwJBAIz3SlyZGnMIaSynDqV4NYw8VmZfgAveFzrEmiRsoQf66yfzUfwQTV22
ywQQmgqNS78m41o+9tQc2MaLFXbrCG0CQQCRe/sr9ICyPspKmyRl7zzNd4vKIrVS
ukq7O5PN3jjlrRMn7yfbdrpnZIpwcCzMBzDkBK5kfb2nP5OhvE4JHLSxAkEA51lC
EcZOsFKNV5xyM/TgKDrRbJgafg6G7NWmRh2zTjSjCtH2s3/AlyDp+WhpSEBzgyjR
EigflWIZxW2UQmbc7w==';

$origin = base64_decode(preg_replace("/\s/", "", $string));
$record = base64_encode($origin);

var_dump($origin, $record);