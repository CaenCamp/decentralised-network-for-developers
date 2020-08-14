import React from 'react';
import { Create, SimpleForm, TextInput, required } from 'react-admin';

export const PlaceCreate = (props) => (
    <Create {...props} title="Création d'un lieu">
        <SimpleForm>
            <TextInput
                fullWidth
                label="Nom du lieu"
                source="name"
                validate={required()}
            />
            <TextInput
                fullWidth
                label="Url du logo"
                source="logo"
            />
            <TextInput
                fullWidth
                label="Url du site web"
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
            <TextInput
                source="address.streetAddress"
                label="Rue"
                fullWidth
                validate={required()}
            />
            <TextInput
                source="address.postalCode"
                label="Code Postal"
                fullWidth
                validate={required()}
            />
            <TextInput
                source="address.addressLocality"
                label="Ville"
                fullWidth
                validate={required()}
            />
        </SimpleForm>
    </Create>
);
