import React from 'react';
import { Create, SimpleForm, TextInput, required } from 'react-admin';

export const OrganizationCreate = (props) => (
    <Create {...props} title="Création d'une boite">
        <SimpleForm>
            <TextInput
                fullWidth
                label="Nom de l'entreprise"
                source="name"
                validate={required()}
            />
            <TextInput
                fullWidth
                label="Url du logo"
                source="image"
            />
            <TextInput
                fullWidth
                label="Url du site web"
                source="url"
                validate={required()}
            />
            <TextInput
                fullWidth
                label="Email principal"
                source="email"
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
                validate={required()}
            />
            <TextInput
                source="location.address.streetAddress"
                label="Rue"
                fullWidth
                validate={required()}
            />
            <TextInput
                source="location.address.postalCode"
                label="Code Postal"
                fullWidth
                validate={required()}
            />
            <TextInput
                source="location.address.addressLocality"
                label="Ville"
                fullWidth
                validate={required()}
            />
        </SimpleForm>
    </Create>
);
