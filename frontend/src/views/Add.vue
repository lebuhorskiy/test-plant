<template>
    <form>
        <router-link class="mb-2" to="/">
            <v-btn color="primary">
                На главную
            </v-btn>
        </router-link>
        <br>
        <br>

        <h1>Добавление растения</h1>
        <v-form @submit.prevent="add">
            <v-text-field
                    v-model="title"
                    :counter="255"
                    label="Имя"
                    required
            ></v-text-field>
            <v-text-field
                    v-model="age"
                    label="Возраст"
                    required
                    :max="100"
                    type="number"
            ></v-text-field>
            <v-select

                    v-model="type"
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
                Добавить
            </v-btn>
        </v-form>
    </form>
</template>

<script>
    import {getTypes, getProtectedProducts} from '../apis/api';
    import PlantsService from '../services/plantsService';

    export default {
        data() {
            return {
                loading: false,
                title: undefined,
                age: undefined,
                type: null,
                products: [],
                types: [],
                products_list: []
            }
        },
        methods: {
            add() {
                if (this.loading) return false;

                let data = {
                    title: this.title,
                    type: this.type,
                    age: this.age,
                    products: this.products,
                }

                this.loading = true;

                PlantsService.add(data).then(() => {
                    this.$noty.success('Растение успешно добавлено');
                    this.$router.push('/');
                }).catch(error => {
                    let msg = error.response.data.error || 'Возникла ошибка';
                    this.$noty.error(msg)
                }).finally(() => {
                    this.loading = false;
                })

            },
            async init() {
                this.loading = true;
                await getTypes().then(response => this.types = response.data);
                await getProtectedProducts().then(response => this.products_list = response.data);
                this.loading = false;
            }
        },
        mounted() {
            this.init();
        }
    }
</script>
