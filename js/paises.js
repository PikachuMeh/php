export async function token() {
    var tokenResponse = await fetch('https://www.universal-tutorial.com/api/getaccesstoken', {
        method: 'GET',
        headers: {
            "Accept": "application/json",
            "api-token": "e2uWgFFOQa7zW452yuNW3MkW9-VBmCqyGGWIsVg5k_bgZ9yvHgko6L4p87akR6kzVMM",
            "user-email": "juanes.malave@gmail.com"
        }
    });
    return await tokenResponse.json();
}

export async function paises(token) {
    var paisResponse = await fetch('https://www.universal-tutorial.com/api/countries', {
        method: 'GET',
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        }
    });
    return await paisResponse.json();
}

export async function estado(pais, token) {
    var estadoResponse = await fetch('https://www.universal-tutorial.com/api/states/' + pais, {
        method: 'GET',
        headers: {
            "Authorization": "Bearer " + token,
            "Accept": "application/json"
        }
    });
    return await estadoResponse.json();
}
