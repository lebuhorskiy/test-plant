<template>

    <div class="plant">
        <router-link class="mb-2" to="/">
            <v-btn color="primary">
                На главную
            </v-btn>
        </router-link>
        <br>
        <br>
        <v-container>
            <h1>{{ plant.title }}</h1>
            <v-form @submit.prevent="update">
                <v-text-field
                        v-model="plant.title"
                        :counter="255"
                        label="Имя"
                        required
                ></v-text-field>
                <v-text-field
                        v-model="plant.age"
                        label="Возраст"
                        required
                        :max="100"
                        type="number"
                ></v-text-field>
                <v-select

                        v-model="plant.type.id"
                        item-text="title"
                        :item-value="'id'"
                        :items="types"
                        label="Выберите тип"
                        required

                ></v-select>
                <v-select
                        multiple
                        chips
                        :item-value="'id'"
                        persistent-hint
                        v-model="products"
                        :items="products_list"
                        label="Выберите продукты для защиты"
                        item-text="title"
                        required
                ></v-select>


                <v-btn
                        :loading="loading"
                        depressed
                        color="primary"
                        type="submit"
                >
                    Обновить
                </v-btn>
            </v-form>

        </v-container>
    </div>
</template>

<script>
    import {getPlant, getProtectedProducts, getTypes} from '../apis/api';
    import PlantsService from "../services/plantsService";

    export default {
        data() {
            return {
                plant: {},
                loading: false,
                products: [],
                types: [],
                products_list: []
            }
        },
        methods: {
            async init() {
                this.loading = true;
                await getTypes().then(response => this.types = response.data);
                await getProtectedProducts().then(response => this.products_list = response.data);
                this.get()
                this.loading = false;
            },
            get() {
                return getPlant(this.$route.params.id).then(response => {
                    this.plant = response.data;
                    this.products = this.plant.products.map(item => item.product.id);
                }).catch(error => {
                    this.$noty.error(error.response.data.error || 'Возникла ошибка');
                })
            },
            update() {
                if (this.loading) return false;

                let data = {
                    id: this.$route.params.id,
                    title: this.plant.title,
                    type: this.plant.type.id,
                    age: this.plant.age,
                    products: this.products,
                }

                this.loading = true;

                PlantsService.update(data).then(() => {
                    this.$noty.success('Растение успешно обновлено');
                }).catch(error => {
                    let msg = error.response.data.error || 'Возникла ошибка';
                    this.$noty.error(msg)
                }).finally(() => {
                    this.loading = false;
                })
            }
        },
        mounted() {
            this.init();
        }
    }
</script>
