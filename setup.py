from pathlib import Path

Path('.htpasswd').touch()

src = Path('.env.example')
dest = Path('.env')

if not(dest.exists()):
    dest.write_text(src.read_text())
