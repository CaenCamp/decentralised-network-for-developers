import React from 'react';
import { Create, SimpleForm, TextInput, required, ReferenceArrayInput, SelectArrayInput } from 'react-admin';

export const PeopleCreate = (props) => (
    <Create {...props} title="Création d'une personne">
        <SimpleForm>
            <TextInput
                fullWidth
                label="Nom"
                source="familyName"
                validate={required()}
            />
            <TextInput
                fullWidth
                label="Prénom"
                source="givenName"
                validate={required()}
            />
            <TextInput
                fullWidth
                label="Url de la photos"
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
            <ReferenceArrayInput label="Membre de" source="memberOf" reference="organizations">
                <SelectArrayInput optionText="name" />
            </ReferenceArrayInput>
        </SimpleForm>
    </Create>
);
