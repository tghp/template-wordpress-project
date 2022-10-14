<?php
/**
 * @var bool $usesReact
 * @var array $cssCritical
 * @var array $cssNonCritical
 * @var array $enqueuedScripts
 */
?>
<?php if ($usesReact): ?>
    <script type="module">
        import RefreshRuntime from '//localhost:<?= VITE_PORT ?>/@react-refresh'
        RefreshRuntime.injectIntoGlobalHook(window)
        window.$RefreshReg$ = () => {}
        window.$RefreshSig$ = () => (type) => type
        window.__vite_plugin_react_preamble_installed__ = true
    </script>
<?php endif ?>

<script type="module" src="//localhost:<?= VITE_PORT ?>/@vite/client"></script>

<?php foreach ($cssCritical as $criticalFile): ?>
    <style type="text/css" class="critical-style" data-vite-url="<?= $criticalFile['url'] ?>" data-vite-load="//localhost:<?= VITE_PORT ?>/<?= $criticalFile['url'] ?>"></style>
<?php endforeach ?>

<?php foreach ($cssNonCritical as $nonCriticalFile): ?>
    <link rel="stylesheet" href="//localhost:<?= VITE_PORT ?>/<?= $nonCriticalFile['url'] ?>" />
<?php endforeach ?>

<?php foreach ($enqueuedScripts as $scriptUrlPath): ?>
    <script type="module" src="//localhost:<?= VITE_PORT ?>/<?= $scriptUrlPath ?>"></script>
<?php endforeach ?>

<script type="text/javascript">
    (() => {
        const replaceCriticalStyle = (url, styleEl, cb) => {
            fetch(url, { headers: { 'Accept': 'text/css' } })
                .then(res => res.text())
                .then(css => {
                    styleEl.innerHTML = css

                    if (cb) {
                        cb();
                    }
                });
        }

        const criticalStyleElements = document.querySelectorAll('.critical-style');
        let criticalStyleElementsToLoadCount = criticalStyleElements.length;

        criticalStyleElements.forEach(styleEl => {
            replaceCriticalStyle(styleEl.dataset.viteLoad, styleEl, () => {
                criticalStyleElementsToLoadCount--;
            });
        });

        const socket = new WebSocket(`ws://localhost:<?= VITE_PORT ?>`, 'vite-hmr');


        socket.addEventListener('open', () => {
            console.info('⚙️ Connected to Vite for critical styles HMR');
        });

        socket.addEventListener('message', async ({ data }) => {
            const message = JSON.parse(data);
            console.info('⚙️ Received HMR update', message);
            handleMessage(message);
        })

        function handleMessage(msg) {
            if (msg.type === 'update' && msg.updates.length) {
                msg.updates.forEach(update => {
                    const matchPath = update.path.replace(/^\//, '')
                        .replace(/\?.*?$/, '');
                    const styleTag = document.querySelector(`style[data-vite-url="${matchPath}"]`);

                    if (styleTag) {
                        replaceCriticalStyle(styleTag.dataset.viteLoad, styleTag);
                    }
                });
            }
        }
    })();
</script>