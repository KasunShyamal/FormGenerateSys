module.exports = {
    proxy: "http://localhost/Training/FormGenerateSys",
    files: ["application/**/*.php", "assets/**/*.css", "assets/**/*.js"],
    injectChanges: true,
    notify: false
};
