const { series } = require('gulp');

module.exports = () => {

    // Add or override tasks here
    /*
    const example = () => {
        Promise.resolve('');
    }
    example.displayName = 'example';
    example.description = 'This is an example task';

    global.gulppress.addTask(example);
    */

    // Change default task here
    const defaultTask = series(
        global.gulppress.getTask('styles'),
        global.gulppress.getTask('scripts')
    );
    defaultTask.displayName = 'default';
    defaultTask.description = 'Compile scripts and styles';

    global.gulppress.setDefaultTask(defaultTask);
};