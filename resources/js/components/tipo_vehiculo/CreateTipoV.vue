<template>
    <div>
        <h3 class="text-center">Crear Tipo de Vehículo</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addTipoV">
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" class="form-control" v-model="tipo.descripcion">
                    </div>
                    <button type="submit" class="btn btn-success">Guardar</button>
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
        methods: {
            addTipoV() {
                this.axios
                    .post('http://localhost:8000/api/tipos', this.tipo)
                    .then(response => (
                        this.$router.push({ name: 'tipov_list' })
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>