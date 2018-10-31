const staticAssets = [
    './',
    './assets/css/style.css',
    './assets/js/main.js'];

const CACHE_STATIC_NAME  = 'page-v1.03';
const CACHE_DYNAMIC_NAME = 'page-dynamic';
const CURRET_CACHE_VER = 1;
self.addEventListener('install', async function () {
  self.skipWaiting();
  //const cache = await caches.open(CACHE_STATIC_NAME);
  //console.log("install",cache.addAll(staticAssets));
});

/*
self.addEventListener('activate', event => {
  console.log('Activating Service Worker ....', event);
  event.waitUntil(
    caches.keys()
      .then(function (keyList) {
        return Promise.all(keyList.map(function (key) {
          if (key !== CACHE_STATIC_NAME && key !== CACHE_DYNAMIC_NAME) {
            console.log('Removing old cache.', key);
            return caches.delete(key);
          }
        }));
      })
  );
  return self.clients.claim();
});

self.addEventListener('fetch', event => {
  const request = event.request;
  const url = new URL(request.url);
  if (url.origin === location.origin) {
    event.respondWith(
      caches.open(CACHE_STATIC_NAME).then(function(cache) {
        return cache.match(event.request).then(function (response) {
          if (response.method == 'POST') {
            return response;
          }
          return response || fetch(event.request).then(function(response) {
            cache.put(event.request, response.clone());
            return response;
          });
        });
      })
    );
  } else {
    event.respondWith(networkFirst(request));
  }
});

function cacheFirst(request) {
  return fetch(request)
    .then(function (res) {
      if(res !== undefined)
      {
        return caches.open(CACHE_STATIC_NAME)
          .then(function (cache) {
            cache.put(request.url, res.clone());
            return res;
          })
      } else {
        const cachedResponse = caches.match(request);
        return cachedResponse;
      }
    })
}

async function networkFirst(request) {
  const dynamicCache = await caches.open(CACHE_DYNAMIC_NAME);
  try {
    const networkResponse = await fetch(request);
    dynamicCache.put(request, networkResponse.clone());
    return networkResponse;
  } catch (err) {
    const cachedResponse = await dynamicCache.match(request);
    return cachedResponse || await caches.match('./cache.json');
  }
}
*/
