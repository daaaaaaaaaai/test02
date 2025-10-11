document.getElementById('searchZip').addEventListener('click', function() {
    let zipcode = document.getElementById('zipcode').value.replace('-', '');
    if (!/^\d{7}$/.test(zipcode)) {
        alert("郵便番号は7桁で入力してください");
        return;
    }

    fetch('/zipcode/' + zipcode)
        .then(res => res.json())
        .then(data => {
            if (data.error) { alert(data.error); return; }

            document.getElementById('prefecture').value = data.prefecture_code ?? '';
            document.getElementById('city').value    = data.city ?? '';
            document.getElementById('address').value = data.address ?? '';
        })
        .catch(() => alert("住所検索に失敗しました"));
});