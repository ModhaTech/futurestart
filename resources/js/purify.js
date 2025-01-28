const purify = require("purify-css")


const htmlFiles = ['resources/views/home.blade.php'];
const cssFiles = ['public/assets/prod/css/main.min.css '];
// const cssFiles = ['https://futurestarr.b-cdn.net/main.min.css'];
const opts = {
    output: 'public/assets/purified.css'
};
purify(htmlFiles, cssFiles, opts, function (res) {
    log(res);
});
