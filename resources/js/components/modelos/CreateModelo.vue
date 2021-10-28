<template>
    <div>
        <h3 class="text-center">Crear Modelo</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addModelo">
                    <div class="form-group">
                        <label>Descripción</label>
                        <input type="text" class="form-control" v-model="modelo.descripcion">
                    </div>
                    <div class="form-group">
                        <label>Marca</label>
                        <select class="form-control" v-model="modelo.marca_id">
                            <option v-bind:value="''">-- Seleccione --</option>
                            <option v-for="marca in marcas" :key="marca.id" v-bind:value="marca.id">{{ marca.nombre }}</option>
                        </select>
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
                modelo: {},
                marcas: []
            }
        },
        created() {
            this.modelo.marca_id = ``
            this.axios
                .get('http://localhost:8000/api/marcas/')
                .then(response => {
                    this.marcas = response.data;
                });
        },
        methods: {
            addModelo() {
                this.axios
                    .post('http://localhost:8000/api/modelos', this.modelo)
                    .then(response => (
                        this.$router.push({ name: 'modelo_list' })
                    ))
                    .catch(err => console.log(err))
                    .finally(() => this.loading = false)
            }
        }
    }
</script>