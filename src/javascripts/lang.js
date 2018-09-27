function setLanguage() {
    var ddlSelection = document.getElementById("cmbLanguage").value;
    switch (ddlSelection) {
        case 'FR':
            document.getElementById('TXT_1').innerHTML = 'De nuit comme de jour, esprit nineties affirmé pour ces sneakers oversize, it-shoes de la rentrée. Coolness revisitée.';
            document.getElementById('CTA_DISCOVER').innerHTML = 'Découvrir';
            document.getElementById('BLOC_2').innerHTML = 'campagne';
            document.getElementById('CTA_DISCOVER1').innerHTML = 'Découvrir';
            document.getElementById('PRODUCT_1').innerHTML = 'Blouson en cuir';
            document.getElementById('PRODUCT_2').innerHTML = 'Robe drapée à carreaux';
            document.getElementById('PRODUCT_3').innerHTML = 'Sneakers à semelle oversize';
            break;
        case 'UK':
            document.getElementById('TXT_1').innerHTML = 'Suitable for evening and day wear, these sneakers have a strong nineties feel and are the must-have shoes this autumn. Coolness revisited.';
            document.getElementById('CTA_DISCOVER').innerHTML = 'Discover';
            document.getElementById('BLOC_2').innerHTML = 'campaign';
            document.getElementById('CTA_DISCOVER1').innerHTML = 'Discover';
            document.getElementById('PRODUCT_1').innerHTML = 'Leather jacket';
            document.getElementById('PRODUCT_2').innerHTML = 'Draped plaid dress';
            document.getElementById('PRODUCT_3').innerHTML = 'Mixed-material sneakers';
            break;
        case 'IE':
            document.getElementById('TXT_1').innerHTML = '';
            document.getElementById('CTA_DISCOVER').innerHTML = '';
            document.getElementById('BLOC_2').innerHTML = '';
            document.getElementById('CTA_DISCOVER1').innerHTML = '';
            document.getElementById('PRODUCT_1').innerHTML = '';
            document.getElementById('PRODUCT_2').innerHTML = '';
            document.getElementById('PRODUCT_3').innerHTML = '';
            break;
        case 'ES':
            document.getElementById('TXT_1').innerHTML = 'Tanto de noche como de día, estas zapatillas grandes de espíritu noventero afirmado son los it-shoes de la nueva temporada. Frescura recreada.';
            document.getElementById('CTA_DISCOVER').innerHTML = 'Descubrir';
            document.getElementById('BLOC_2').innerHTML = 'campaña';
            document.getElementById('CTA_DISCOVER1').innerHTML = 'Descubrir';
            document.getElementById('PRODUCT_1').innerHTML = 'Cazadora de cuero';
            document.getElementById('PRODUCT_2').innerHTML = 'Vestido drapeado de cuadros';
            document.getElementById('PRODUCT_3').innerHTML = 'Sneakers en mezcla de materias';
            break;
        case 'DE':
            document.getElementById('TXT_1').innerHTML = 'In der Nacht und am Tag, Oversize-Sneakers im Look der Nineties – Die IT-Shoes für den Herbst. Die neue Art der Coolness.';
            document.getElementById('CTA_DISCOVER').innerHTML = 'Entdecken';
            document.getElementById('BLOC_2').innerHTML = 'kampagne';
            document.getElementById('CTA_DISCOVER1').innerHTML = 'Entdecken';
            document.getElementById('PRODUCT_1').innerHTML = 'Motorrad-Lederjacke';
            document.getElementById('PRODUCT_2').innerHTML = 'Drapiertes Karo-Kleid';
            document.getElementById('PRODUCT_3').innerHTML = 'Sneakers aus verschiedenen Materialien';
            break;
        case 'IT':
            document.getElementById('TXT_1').innerHTML = 'Di notte come di giorno, acclamato spirito anni ‘90 per queste sneaker oversize, le it-shoes del rientro. Coolness rivisitata.';
            document.getElementById('CTA_DISCOVER').innerHTML = 'Scoprire';
            document.getElementById('BLOC_2').innerHTML = 'campagna';
            document.getElementById('CTA_DISCOVER1').innerHTML = 'Scoprire';
            document.getElementById('PRODUCT_1').innerHTML = 'Giubbotto in pelle';
            document.getElementById('PRODUCT_2').innerHTML = 'Vestito drappeggiato a quadri';
            document.getElementById('PRODUCT_3').innerHTML = 'Sneakers multimateriale';
            break;
        case 'FL':
            document.getElementById('TXT_1').innerHTML = '';
            document.getElementById('CTA_DISCOVER').innerHTML = '';
            document.getElementById('BLOC_2').innerHTML = '';
            document.getElementById('CTA_DISCOVER1').innerHTML = '';
            document.getElementById('PRODUCT_1').innerHTML = '';
            document.getElementById('PRODUCT_2').innerHTML = '';
            document.getElementById('PRODUCT_3').innerHTML = '';
            break;
    }
}