from os.path import exists
from shutil import copyfile
from pathlib import Path


if not(exists('.env')):
    copyfile('.env.example', '.env')

Path('.htpasswd').touch()
