<template>
    <v-dialog
            @click:outside="$emit('decline')"
            v-model="dialog"
            max-width="290"
    >
        <v-card>
            <v-card-title class="text-h5">
                Предупреждение
            </v-card-title>

            <v-card-text>
                Вы уверены что хотите удалить растение?
            </v-card-text>

            <v-card-actions>
                <v-spacer></v-spacer>

                <v-btn
                        color="red darken-1"
                        text
                        @click="$emit('decline')"
                >
                    Отмена
                </v-btn>

                <v-btn
                        :loading="loading"
                        color="green darken-1"
                        text
                        @click="$emit('confirm')"
                >
                    Да
                </v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>

<script>
    export default {
        props: {
            loading: {
                type: Boolean,
                default: false
            },
            dialog: {
                default: false,
                type: Boolean
            }
        }
    }
</script>
