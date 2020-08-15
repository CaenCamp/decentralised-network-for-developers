import React from 'react';
import { Create, SimpleForm, TextInput, required } from 'react-admin';

export const CreativeWorkCreate = (props) => (
    <Create {...props} title="Création d'un talk">
        <SimpleForm>
            <TextInput
                fullWidth
                label="Nom"
                source="name"
                validate={required()}
            />
            <TextInput
                fullWidth
                multiline
                label="Résumé"
                source="disambiguatingDescription"
                validate={required()}
            />
            <TextInput
                fullWidth
                multiline
                label="Présentation"
                source="abstract"
            />
        </SimpleForm>
    </Create>
);
