import React from 'react';
import { Create, SimpleForm, TextInput, required } from 'react-admin';

export const EventCreate = (props) => (
    <Create {...props} title="Création d'un lieu">
        <SimpleForm>
            <TextInput
                fullWidth
                label="Nom de l'évènement"
                source="name"
                validate={required()}
            />
           <TextInput
                fullWidth
                label="Url de l'image"
                source="logo"
            />
            <TextInput
                fullWidth
                label="Url de la conférence si en ligne"
                source="url"
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
                source="description"
            />
        </SimpleForm>
    </Create>
);
