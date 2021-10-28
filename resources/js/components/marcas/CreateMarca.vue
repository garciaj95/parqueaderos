<template>
    <div>
        <h3 class="text-center">Crear Marca</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addMarca">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" class="form-control" v-model="marca.nombre">
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
                marca: {}
            }
        },
        methods: {
            addMarca() {
                this.axios
                    .post('http://localhost:8000/api/marcas', this.marca)
                    .then(response => (
                        this.$router.push({ name: 'marca_list' })
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>