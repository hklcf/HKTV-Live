@echo off
copy /b *.ts all_in_one.ts
ffmpeg -i "all_in_one.ts" -c copy -bsf:a aac_adtstoasc "output.mp4"
del *.m3u8 *.ts