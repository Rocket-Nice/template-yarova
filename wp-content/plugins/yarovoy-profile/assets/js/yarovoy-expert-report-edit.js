document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('yarovoy-expert-report-edit-btn');
    if (!btn) return;
    btn.addEventListener('click', function (e) {
        e.preventDefault();
        var reportIdInput = document.getElementById('yarovoy-expert-report-edit-id');
        if (!reportIdInput) return;
        var reportId = reportIdInput.value;
        if (!reportId) {
            alert('Введите ID отчёта!');
            return;
        }
        var url = '/wp-json/yarovoy/v1/profile/expert/report/' + reportId;
        var headers = {};
        if (typeof yarovoyApi !== 'undefined' && yarovoyApi.nonce) {
            headers['X-WP-Nonce'] = yarovoyApi.nonce;
        }
        fetch(url, {
            method: 'GET',
            headers: headers,
        })
            .then(function (response) {
                if (!response.ok) {
                    return response.json().then(function (err) {
                        let msg = 'Ошибка: ' + response.status;
                        if (err && err.message) {
                            msg += '\n' + err.message;
                        }
                        console.error(msg);
                        throw new Error(msg);
                    }).catch(function () {
                        console.error('Ошибка: ' + response.status);
                    });
                }
                return response.json();
            })
            .then(function (data) {
                if (data) {
                    console.log('Ответ API (edit):', data);
                }
            })
            .catch(function (error) {
            });
    });
});
