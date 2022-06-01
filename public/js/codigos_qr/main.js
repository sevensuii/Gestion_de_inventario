$(document).ready(function () {

    $('#btn-redirect').hide();

    var html5QrcodeScanner = new Html5QrcodeScanner(
        "reader", { fps: 60, qrbox: 250 });

    function onScanSuccess(decodedText, decodedResult) {
        // Handle on success condition with the decoded text or result.
        console.log(`Scan result: ${decodedText}`, decodedResult);
        $('#btn-redirect').prop('href', `/objetos/show/${decodedText}`);
        $('#btn-redirect').show();
        // ...
        // html5QrcodeScanner.clear();
        // ^ this will stop the scanner (video feed) and clear the scan area.
    }

    html5QrcodeScanner.render(onScanSuccess);
});
