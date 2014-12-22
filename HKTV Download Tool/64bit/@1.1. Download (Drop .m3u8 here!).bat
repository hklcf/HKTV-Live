@echo off
ffmpeg -i "%~f1" -c copy "%~n1.ts"
