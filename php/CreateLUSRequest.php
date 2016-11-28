<?php
/*+-------------+----------------------------------------------------------*
 *|        /\   |     University of Heidelberg                             *
 *|       |  |  |     Department of Geography                              *
 *|      _|  |_ |     GIScience Research Group                             *
 *|    _/      \|                                                          *
 *|___|         |                                                          *
 *|             |     Berliner Straße 48                                   *
 *|             |     D-69221 Heidelberg, Germany                          *
 *+-------------+----------------------------------------------------------*/
/**
 * <p><b>Title: RS </b></p>
 * <p><b>Description:</b> Functions for Geocoding </p>
 *
 * <p><b>Copyright:</b> Copyright (c) 2015</p>
 * <p><b>Institution:</b> University of Heidelberg, Department of Geography</p>
 * @author Amandus Butzer, Timothy Ellersiek, openrouteservice at geog.uni-heidelberg.de
 * @version 2.0 2016-11-03
 */


///////////////////////////////////////////////////
//Function die XML Request an OpenLS LUS erstellt

function createGeocodeRequest($object)
{
    $request = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
					<xls:XLS xmlns:xls=\"http://www.opengis.net/xls\" xmlns:sch=\"http://www.ascc.net/xml/schematron\"
					xmlns:gml=\"http://www.opengis.net/gml\" xmlns:xlink=\"http://www.w3.org/1999/xlink\"
					xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
					xsi:schemaLocation=\"http://www.opengis.net/xls http://schemas.opengis.net/ols/1.1.0/LocationUtilityService.xsd\"
					version=\"1.1\">
						<xls:RequestHeader/>
						<xls:Request methodName=\"GeocodeRequest\" requestID=\"123456789\" version=\"1.1\" maximumResponses=\"";
	
	/** Set the default of MaxResponse to 20 if not set */
    $request = (isset($object->MaxResponse)) ? $request . "$object->MaxResponse" : $request . "20";
    
    $request .= "\">
					<xls:GeocodeRequest>
						<xls:Address countryCode=\"";
    
	/** Set the default language to English if not set */
    $request = (isset($object->lang)) ? $request . "$object->lang" : $request . "de";
    
    /** insert the Adress search parameter */
    $request .= "\">
					    <xls:freeFormAddress>$object->FreeFormAddress</xls:freeFormAddress>
					</xls:Address>
				</xls:GeocodeRequest>
			</xls:Request>
		</xls:XLS>";
    return $request;
}

function createRevGeocodeRequest($object)
{
    $request = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
					<xls:XLS xmlns:xls=\"http://www.opengis.net/xls\" xmlns:sch=\"http://www.ascc.net/xml/schematron\"
					xmlns:gml=\"http://www.opengis.net/gml\" xmlns:xlink=\"http://www.w3.org/1999/xlink\"
					xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\"
					xsi:schemaLocation=\"http://www.opengis.net/xls http://schemas.opengis.net/ols/1.1.0/LocationUtilityService.xsd\"
					version=\"1.1\">
						<xls:RequestHeader/>
							<xls:Request methodName=\"ReverseGeocodeRequest\" requestID=\"123456789\" version=\"1.1\" maximumResponses=\"1\">
								<xls:ReverseGeocodeRequest>
									<xls:Position>
										<gml:Point>
											<gml:pos>$object->pos</gml:pos>
										</gml:Point>
									</xls:Position>
								</xls:ReverseGeocodeRequest>
							</xls:Request>
						</xls:XLS>";
    return utf8_decode($request);
}
