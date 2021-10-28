<template>
    <div>
        <h2 class="text-center">Listado de Modelos</h2>
 
        <div class="col-md-12 text-right">
            <router-link :to="{name: 'modelo_create'}" class="nav-item nav-link">Nuevo Modelo</router-link>
        </div>
        <div class="col-md-12 table-responsive">
            <table class="table" >
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Descripción</th>
                    <th>Marca</th>
                    <th></th>
                </tr>
                </thead>
                <tbody v-if="verificarListado">
                    <tr v-for="modelo in modelos" :key="modelo.id">
                        <td>{{ modelo.id }}</td>
                        <td>{{ modelo.descripcion }}</td>
                        <td>{{ modelo.marca.nombre }}</td>
                        <td>
                            <div class="btn-group" role="group">
                                <router-link :to="{name: 'modelo_edit', params: { id: modelo.id }}" class="btn btn-primary">
                                    <i class="fa fa-pencil"></i>
                                </router-link>
                                <button class="btn btn-danger" @click="deleteModelo(modelo.id)">
                                    <i class="fa fa-trash"></i>
                                </button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
 
<script>
    export default {
        data() {
            return {
                modelos: []
            }
        },
        computed: {
            verificarListado() {
                return this.modelos.length > 0
            }
        },
        created() {
            this.axios
                .get('http://localhost:8000/api/modelos/')
                .then(response => {
                    this.modelos = response.data;
                });
        },
        methods: {
            deleteModelo(id) { 
                this.axios
                    .delete(`http://localhost:8000/api/modelos/${id}`)
                    .then(response => {
                        let i = this.modelos.map(data => data.id).indexOf(id);
                        this.modelos.splice(i, 1)
                    });
            }
        }
    }
</script>