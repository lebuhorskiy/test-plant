import Vue from 'vue';

export function getPlants()
{
    return Vue.axios.get('plants');
}
export function getTypes()
{
    return Vue.axios.get('plants/types');
}
export function getProtectedProducts()
{
    return Vue.axios.get('plants/protection-products');
}

export function addPlant(data)
{
    return Vue.axios.post('plants/add', data)
}

export function deletePlant(id) {
    return Vue.axios.delete('plant', {
        params: {
            id
        }
    })
}


export function getPlant(id) {
    return Vue.axios.get('plant', {
        params: {
            id
        }
    })
}

export function updatePlant(data) {
    return Vue.axios.put('plant', data);
}
