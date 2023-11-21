import vitepress from '@tghp/vitepress';

const vitepressInstance: ReturnType<typeof vitepress> = vitepress({
  root: __dirname,
  preact: true,
});

export default vitepressInstance;