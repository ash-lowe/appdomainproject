var app = require('app');  // controls application life.
var BrowserWindow = require('browser-window'); 

require('crash-reporter').start();

var mainWindow = null;

app.on('window-all-closed', function () {
    app.quit();
});