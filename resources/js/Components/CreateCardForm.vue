<template>
    <div>
        <form @submit.prevent="submit">
            <input type="text" v-model="form.title" />
            <button type="submit">Create</button>
        </form>
    </div>
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
            column_id: props.columnId,
        });

        const submit = () => {
            form.post("/cards", {
                preserveScroll: true,
                onSuccess: () => {
                    form.reset();
                },
            });
        };

        return {
            form,
            submit,
        };
    },
};
</script>
