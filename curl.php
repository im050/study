<?php
/**
 * Created by PhpStorm.
 * User: linyulin
 * Date: 17/2/28
 * Time: 下午3:51
 */

$stream = "POST /index.unifypay?action=MemberTransaction&version=2 HTTP/1.0
User-Agent: Wget/1.12 (linux-gnu)
Accept: */*
Host: 15702710yt.51mypc.cn:8400
Connection: Keep-Alive
Content-type: text/plain;charset=utf-8
Content-Length: 306

partnerCode=XTFTEST&encryptData=eyJub3RpZnlVcmwiOiJodHRwOi8vMTU3MDI3MTB5dC41MW15cGMuY246ODQwMC9pbmRleC51bmlmeXBheT9hY3Rpb249cGF5bm90aWZ5dGVzdCIsIm9yZGVyTm8iOiJUNDU2NTc5OTk0OTM3NiIsImJpemNvZGUiOiIxMDAzIiwibWVtYmVyTm8iOiI4MzQxMDAwNTcyMjAwNzkiLCJ0cmFuc0FtdCI6MTAwMH0K&signData=D3C63AD996EFD8F4E8DBE5A4903FD212";