import React from "react";
import { HydraAdmin, fetchHydra, hydraDataProvider } from "@api-platform/admin"; // ResourceGuesser, 
import { Resource } from 'react-admin';
import { parseHydraDocumentation } from "@api-platform/api-doc-parser";

import Organization from './Organizations';
import People from './People';

const entrypoint = process.env.REACT_APP_API_ENTRYPOINT;

const dataProvider = hydraDataProvider(
    entrypoint,
    fetchHydra,
    parseHydraDocumentation,
    true // useEmbedded parameter
);

export default () => (
    <HydraAdmin
        dataProvider={ dataProvider }
        entrypoint={ entrypoint }
    >
        <Resource name="people" {...People} />
        <Resource name="organizations" {...Organization} />
  </HydraAdmin>
);
