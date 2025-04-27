import { context } from 'esbuild';
import { glob } from 'tinyglobby';

const files = await glob(['assets/*.{js,css}', '!assets/*.min.{js,css}']);

const ctx = await context({
    entryPoints: files,
    outdir: 'assets',
    outExtension: {
        '.js': '.min.js',
        '.css': '.min.css',
    },
    minify: true,
    allowOverwrite: true,
});
ctx.watch();
