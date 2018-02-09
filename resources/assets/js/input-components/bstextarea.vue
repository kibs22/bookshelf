<template>

    <div class="form-group" v-bind:class="{'text-danger': error.length}">
        <label class="control-label" v-bind:for="id">{{ label }}</label>
        <textarea class="form-control" v-bind:value="value" v-bind:class="inputClass" v-bind:id="id" v-on:input="updateModel($event.target.value)"> </textarea>
        <span v-show="error" class="help-block" >{{ error[0] }}</span>
    </div>




</template>

<script>
    export default {
        props: {
            label: {
                type: String,
                default: ''
            },
            id: {
                type: String,
                default: ''
            },
            value:{
                type:'',
                default:''
            },
            'input-class':  {
                type: String,
                default: ''
            },
            error: {
                // type: Object,
                default: ''
            }
           
        },
        methods: {
            updateModel(value) {
                this.$emit('input', value)
            },
        }
    }
</script>