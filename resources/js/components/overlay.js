exports.showOverlay = function() {
    document.querySelector('div.overlay').classList.remove('el-hide');
};

exports.closeOverlay = function() {
    document.querySelector('div.overlay').classList.add('el-hide');
};