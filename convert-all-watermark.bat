@echo off
echo === Conversion PNG/JPG -> WebP avec watermark ===

:: dossier projects
cd "C:\Users\Utilisateur\Desktop\portfolio\public\images\projects"
for %%i in (*.png *.jpg) do (
  magick "%%i" -auto-orient -gravity center -pointsize 50 -fill "rgba(255,255,255,0.3)" -annotate 45 "© Sylvie Seguinaud" "%%~ni.webp"
)

:: dossier figma
cd "C:\Users\Utilisateur\Desktop\portfolio\public\images\projects\figma"
for %%i in (*.png *.jpg) do (
  magick "%%i" -auto-orient -gravity center -pointsize 50 -fill "rgba(255,255,255,0.3)" -annotate 45 "© Sylvie Seguinaud" "%%~ni.webp"
)

:: dossier voyages
cd "C:\Users\Utilisateur\Desktop\portfolio\public\images\voyages"
for %%i in (*.png *.jpg) do (
  magick "%%i" -auto-orient -gravity center -pointsize 50 -fill "rgba(255,255,255,0.3)" -annotate 45 "© Sylvie Seguinaud" "%%~ni.webp"
)

echo ✅ Conversion terminée avec watermark !
pause

