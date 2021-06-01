import {addPlant, deletePlant, updatePlant} from '../apis/api';

export default class PlantsService {
    static add(data) {
        return addPlant(data).then(response => response.data)
    }

    static delete(id) {
        return deletePlant(id).then(response => response.data)
    }

    static update(data) {
        return updatePlant(data).then(response => response.data);
    }

}
