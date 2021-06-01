<template>
    <div class="home">
        <h1 class="mb-5">Список растений</h1>
        <v-row>
            <v-col>
                <router-link to="/add">
                    <v-btn
                            depressed
                            color="primary"
                    >
                        Добавить растение
                    </v-btn>
                </router-link>
            </v-col>
        </v-row>
        <v-container class="grey mt-5 lighten-5 mb-6">
            <v-row :gutters="20">
                <v-col v-for="(item,i) in plants"
                       :key="i">
                    <v-card
                            class="mx-auto"
                    >
                        <router-link :to="`/plant/${item.id}`">
                            <v-card-subtitle class="pb-0">
                                {{ item.title }}
                            </v-card-subtitle>
                        </router-link>

                        <v-card-text class="text--primary">
                            <p>
                                Тип растения: {{ item.type.title }}
                            </p>
                            <template v-if="item.products.length > 0">
                                <p>Продукты для защиты:</p>
                            </template>
                            <template v-else>Продуктов для защиты нет</template>
                            <v-row>
                                <v-chip
                                        v-for="(product, k) in item.products"
                                        :key="k"
                                        class="ma-2"
                                        color="pink"
                                        label
                                        text-color="white"
                                >
                                    <v-icon left>
                                        mdi-label
                                    </v-icon>
                                    {{ product.product.title }}
                                </v-chip>

                            </v-row>
                        </v-card-text>

                        <v-card-actions>
                            <router-link :to="`/plant/${item.id}`">
                                <v-btn
                                        color="orange"
                                        text
                                >
                                    Редактировать
                                </v-btn>
                            </router-link>

                            <v-btn
                                    @click="deleteId = item.id"
                                    color="red"
                                    text
                            >
                                Удалить
                            </v-btn>
                        </v-card-actions>
                    </v-card>
                </v-col>

            </v-row>
        </v-container>
        <confirm-delete @confirm="deletePlant"
                        @outside="close"
                        :loading="loading"
                        :dialog="(deleteId ? true : false)"
                        @decline="close">
        </confirm-delete>
    </div>
</template>

<script>
    import {mapActions, mapGetters, mapMutations} from 'vuex';
    import ConfirmDelete from '../components/ConfirmDelete';
    import PlantsService from '../services/plantsService';

    export default {
        data() {
            return {
                loading: false,
                deleteId: undefined,
            }
        },
        name: 'Home',
        methods: {
            ...mapMutations(['DELETE_PLANT']),
            ...mapActions(['getPlants']),
            init() {
                this.getPlants();
            },
            close() {
                this.deleteId = undefined;
            },
            deletePlant() {
                this.loading = true;
                PlantsService.delete(this.deleteId).then(() => {
                    this.DELETE_PLANT(this.deleteId)
                    this.$noty.success('Растение успешно удалено')
                }).catch(error => {
                    this.$noty.error(error.response.data.error || 'Возникла ошибка')
                }).finally(() => {
                    this.loading = false;
                    this.deleteId = undefined;
                });
            }
        },
        computed: {
            ...mapGetters(['plants']),
        },
        mounted() {
            this.init();
        },
        components: {
            ConfirmDelete
        }
    }
</script>
