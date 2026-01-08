const tabButtons = document.querySelectorAll('.tab-button');
const productPanes = document.querySelectorAll('.product-pane');

function changeTab(productName) {
    productPanes.forEach(pane => {
        pane.classList.add('hidden');
    });
    
    tabButtons.forEach(button => {
        button.classList.remove('tab-active');
        button.classList.add('text-gray-300', 'hover:bg-gray-700');
    });

    document.getElementById(`pane-${productName}`).classList.remove('hidden');
    
    const activeButton = document.getElementById(`tab-${productName}`);
    activeButton.classList.add('tab-active');
    activeButton.classList.remove('text-gray-300', 'hover:bg-gray-700');
}

document.addEventListener('DOMContentLoaded', () => {
    changeTab('balam');
});