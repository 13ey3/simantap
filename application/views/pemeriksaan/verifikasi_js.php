<script type="text/javascript">
    ready(() => {
        if (typeof attribut_ijin !== 'undefined') {
            _formAttribut.innerHTML = form_build(attribut_ijin);
        }
    });
    var attribut_ijin = <?= $data_attribut; ?>;
    const _formAttribut = document.getElementById('attribut_permohonan');
    
</script>