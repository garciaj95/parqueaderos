<template>
    <div>
        <h3 class="text-center">Editar Marca</h3>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateModelo">
                    <div class="form-group">
                        <label>Descripción</label>
                        <input required type="text" class="form-control" v-model="modelo.descripcion">
                    </div>
                    <div class="form-group">
                        <label>Marca</label>
                        <select class="form-control" required v-model="modelo.marca_id">
                            <option v-bind:value="''">-- Seleccione --</option>
                            <option v-for="marca in marcas" :key="marca.id" v-bind:value="marca.id">{{ marca.nombre }}</option>
                        </select>
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
                modelo: {},
                marcas: []
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/marcas/')
                .then(response => {
                    this.marcas = response.data;
                });
    
            this.axios
                .get(`http://localhost:8000/api/modelos/${this.$route.params.id}`)
                .then((res) => {
                    this.modelo = res.data;
                });
        },
        methods: {
            updateModelo() {
                this.axios
                    .patch(`http://localhost:8000/api/modelos/${this.$route.params.id}`, this.modelo)
                    .then((res) => {
                        this.$router.push({ name: 'modelo_list' });
                    });
            }
        }
    }
</script>