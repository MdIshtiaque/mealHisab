import './bootstrap';

let deferredPrompt;

// Register Service Worker
if ('serviceWorker' in navigator) {
    window.addEventListener('load', () => {
        navigator.serviceWorker.register('/build/sw.js')
            .then(registration => {
                console.log('ServiceWorker registration successful');
            })
            .catch(error => {
                console.log('ServiceWorker registration failed:', error);
            });
    });
}

// Capture install prompt
window.addEventListener('beforeinstallprompt', (e) => {
    e.preventDefault();
    deferredPrompt = e;
    // Show install button
    const installButton = document.getElementById('pwa-install-button');
    if (installButton) {
        installButton.classList.remove('hidden');
    }
});

// Handle successful installation
window.addEventListener('appinstalled', () => {
    deferredPrompt = null;
    // Hide install button
    const installButton = document.getElementById('pwa-install-button');
    if (installButton) {
        installButton.classList.add('hidden');
    }
    console.log('PWA was installed');
});

// Export for use in other files
window.installPWA = async () => {
    if (deferredPrompt) {
        deferredPrompt.prompt();
        const { outcome } = await deferredPrompt.userChoice;
        deferredPrompt = null;
    }
};
