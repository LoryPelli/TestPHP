import { copyFile, constants } from 'node:fs/promises';

copyFile('.env.example', '.env', constants.COPYFILE_EXCL).catch(() => {});
