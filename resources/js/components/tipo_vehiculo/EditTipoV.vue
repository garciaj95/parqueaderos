<template>
    <div>
        <h3 class="text-center">Editar Tipo de Vehículo</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateTipoV">
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" class="form-control" v-model="tipo.descripcion">
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar</button>
                </form>
            </div>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                tipo: {}
            }
        },
        created() {
            this.axios
                .get(`http://localhost:8000/api/tipos/${this.$route.params.id}`)
                .then((res) => {
                    this.tipo = res.data;
                });
        },
        methods: {
            updateTipoV() {
                this.axios
                    .patch(`http://localhost:8000/api/tipos/${this.$route.params.id}`, this.tipo)
                    .then((res) => {
                        this.$router.push({ name: 'tipov_list' });
                    });
            }
        }
    }
</script>