@echo off
for %%a in (*.m3u8) do cmd /c ffmpeg -i "%%a" -c copy "%%a.ts"
ren *.m3u8.ts *.ts
