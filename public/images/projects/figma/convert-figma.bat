@echo off
echo === Conversion PNG/JPG -> WebP dans figma ===
cd "C:\Users\Utilisateur\Desktop\portfolio\public\images\projects\figma"
for %%i in (*.png *.jpg) do "C:\Users\Utilisateur\Desktop\tools\libwebp-1.3.2-windows-x64\bin\cwebp.exe" "%%i" -q 80 -o "%%~ni.webp"
echo Conversion terminee !
pause
