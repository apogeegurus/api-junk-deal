require('./bootstrap');

$.ajaxSetup({
    data: {
        _token: $('meta[name=csrf-token]').attr('content')
    }
})
