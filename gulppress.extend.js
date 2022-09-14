const { series } = require('gulp');

module.exports = () => {
    // Use preact instead of react
    // global.gulppress.setOption('preact', true);

    // Change default task here
    const defaultTask = series(
        global.gulppress.getTask('styles'),
        global.gulppress.getTask('scripts')
    );
    defaultTask.displayName = 'default';
    defaultTask.description = 'Compile scripts and styles';

    global.gulppress.setDefaultTask(defaultTask);
};