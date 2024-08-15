const readAnalyticsCookie = (name) => {
    let result = document.cookie.match("(^|[^;]+)\\s*" + name + "\\s*=\\s*([^;]+)")
    return result ? result.pop() : ""
}

/**
 * Log page visit whenever the page is loaded
 */
if (document.readyState === "loading") daPageView();

async function sendData(url = '', data = {}) {
    const response = await fetch(url, {
        method: 'POST',
        mode: 'cors',
        cache: 'no-cache',
        credentials: 'same-origin',
        headers: {
            'Content-Type': 'application/json'
        },
        redirect: 'follow',
        referrerPolicy: 'no-referrer',
        body: JSON.stringify(data)
    });
    return response.json();
}

/**
 * Send the pages views analytics
 */
async function daPageView(cookie) {
    return sendData(`${self.origin}/api/track-page-views`, {
        page_name: window.location.pathname,
        device: getResolution(),
        cookie: readAnalyticsCookie('rwb_a')
    })
        .catch(err => { console.log(err) });
}

/**
 * Send the features | hits analytics
 * @param {string} featureName
 */
async function daFeatureVisit(featureName) {
    return sendData(`${self.origin}/api/track-feature-visit`, {
        feature_name: featureName,
        device: getResolution(),
        client_cookie: readAnalyticsCookie('rwb_a')
    })
        .catch(err => { console.log(err) });
}

/**
 * Detect and return the device screen resolution
 * @return {number}
 */
function getResolution() {
    // > 1200 = web
    // < 450 = mobile
    const screenWidth = screen.width;
    const screenHeight = screen.height;

    return screenWidth;
}



