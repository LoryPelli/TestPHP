from os.path import exists
from shutil import copyfile


if not(exists('.env')):
    copyfile('.env.example', '.env')
