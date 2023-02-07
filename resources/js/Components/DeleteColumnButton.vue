<template>
    <button @click="submit">Delete Column</button>
</template>

<script>
import { useForm } from "@inertiajs/vue2";

export default {
    props: {
        columnId: {
            type: Number,
            required: true,
        },
    },
    setup(props) {
        const form = useForm({
            title: "",
        });

        const submit = () => {
            form.delete(`/columns/${props.columnId}`, {
                preserveScroll: true,
            });
        };

        return {
            form,
            submit,
        };
    },
};
</script>
