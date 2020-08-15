import React from 'react';
import { Create, SimpleForm, TextInput, required } from 'react-admin';

export const MediaCreate = (props) => (
    <Create {...props} title="Création d'un support de présentation">
        <SimpleForm>
            <TextInput
                fullWidth
                label="Déscription"
                source="abstract"
                validate={required()}
            />
        </SimpleForm>
    </Create>
);
