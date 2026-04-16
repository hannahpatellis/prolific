const CACHE_VERSION = 'v1';
const STATIC_CACHE = `prolific-static-${CACHE_VERSION}`;

// Static assets to precache on install
const PRECACHE_URLS = [
  '/assets/css/style.css',
  '/assets/js/primary.js',
  '/apple-touch-icon.png',
  '/favicon.svg',
  '/favicon.ico',
  '/favicon-96x96.png',
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(STATIC_CACHE).then(cache => cache.addAll(PRECACHE_URLS))
  );
  self.skipWaiting();
});

self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(keys =>
      Promise.all(
        keys
          .filter(key => key.startsWith('prolific-') && key !== STATIC_CACHE)
          .map(key => caches.delete(key))
      )
    )
  );
  self.clients.claim();
});

self.addEventListener('fetch', event => {
  const { request } = event;
  const url = new URL(request.url);

  // Only handle same-origin requests
  if (url.origin !== self.location.origin) return;

  const isStaticAsset = url.pathname.startsWith('/assets/') ||
    /\.(png|jpg|jpeg|gif|svg|ico|webp|woff2?|ttf|otf)$/.test(url.pathname);

  if (isStaticAsset) {
    // Cache-first for static assets
    event.respondWith(
      caches.match(request).then(cached => {
        if (cached) return cached;
        return fetch(request).then(response => {
          if (response.ok) {
            const clone = response.clone();
            caches.open(STATIC_CACHE).then(cache => cache.put(request, clone));
          }
          return response;
        });
      })
    );
  } else {
    // Network-first for PHP pages (dynamic, session-dependent)
    event.respondWith(
      fetch(request).catch(() => caches.match(request))
    );
  }
});
